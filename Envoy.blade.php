@setup
    $repo = 'git@github.com:railto/PersonalSite.git';
    $baseDir = '/home/forge/markrailton.com';
    $releaseDir = $baseDir . '/releases';
    $currentDir = $baseDir . '/current';
    $release = date('Ymd-His');
    $currentReleaseDir = $releaseDir . '/' . $release;

    function logMessage($message) {
        return "echo '\033[32m" .$message. "\033[0m';\n";
    }
@endsetup

@servers(['forge@forge.markrailton.com'])

@story('deploy')
    git
    composer
    npm_install
    npm_run_prod
    update_symlinks
    migrate
    optimize
    clean_old_releases
@endstory

@task('backup')
    {{ logMessage("Backing up") }}

    php {{ $currentDir }}/artisan backup:run
@endtask

@task('git')
    {{ logMessage("Cloning repository") }}

    git clone {{ $repo }} --branch=main --depth=1 -q {{ $currentReleaseDir }}
@endtask

@task('composer')
    {{ logMessage("Running composer") }}

    cd {{ $currentReleaseDir }}

    composer install --no-interaction --quiet --no-dev --prefer-dist --optimize-autoloader
@endtask

@task('npm_install')
    {{ logMessage("NPM install") }}

    cd {{ $currentReleaseDir }}

    npm install --silent --no-progress
@endtask

@task('npm_run_prod')
    {{ logMessage("NPM run prod") }}

    cd {{ $currentReleaseDir }}

    npm run prod --silent --no-progress
@endtask

@task('migrate')
    {{ logMessage("Running migrations") }}

    php {{ $currentReleaseDir }}/artisan migrate --force
@endtask

@task('optimize')
    {{ logMessage("Optimizing Laravel") }}

    php {{ $currentReleaseDir }}/artisan optimize
@endtask

@task('update_symlinks')
    {{ logMessage("Updating symlinks") }}

    # Remove the storage directory and replace with persistent data
    {{ logMessage("Linking storage directory") }}
    rm -rf {{ $currentReleaseDir }}/storage
    ln -nfs {{ $baseDir }}/storage {{ $currentReleaseDir }}/storage

    # Remove the public uploads directory and replace with persistent data
    {{ logMessage("Linking uploads directory") }}
    rm -rf {{ $currentReleaseDir }}/public/uploads
    ln -nfs {{ $baseDir }}/uploads {{ $currentReleaseDir }}/public/uploads

    # Import the environment config
    {{ logMessage("Linking .env file") }}
    ln -nfs {{ $baseDir }}/.env {{ $currentReleaseDir }}/.env

    # Symlink the latest release to the current directory
    {{ logMessage("Linking current release") }}
    ln -nfs {{ $currentReleaseDir }} {{ $currentDir }}
@endtask

@task('clean_old_releases')
    # Delete all but the 5 most recent releases
    {{ logMessage("Cleaning old releases") }}
    cd {{ $releaseDir }}
    ls -dt {{ $releaseDir }}/* | tail -n +6 | xargs -d "\n" rm -rf;
@endtask

@task('init')
    if [ ! -d {{ $baseDir }}/current ]; then
        cd {{ $baseDir }}
        git clone {{ $repo }} --branch=main --depth=1 -q {{ $release }}
        {{ logMessage("Repository cloned") }}
        mv {{ $release }}/storage {{ $baseDir }}/storage
        ln -s {{ $baseDir }}/storage {{ $release }}/storage
        ln -s {{ $baseDir }}/storage/public {{ $release }}/public/storage
        {{ logMessage("Storage directory set up") }}
        cp {{ $release }}/.env.example {{ $baseDir }}/.env
        ln -s {{ $baseDir }}/.env {{ $release }}/.env
        {{ logMessage("Environment file set up") }}
        rm -rf {{ $release }}
        {{ logMessage("Deployment path initialised. Run 'envoy run deploy' now.") }}
    else
        {{ logMessage("Deployment path already initialised (current symlink exists)!") }}
    fi
@endtask

@task('rollback')
    cd {{ $releaseDir }}
    ln -nfs {{ $releaseDir }}/$(find . -maxdepth 1 -name "20*" | sort  | tail -n 2 | head -n1) {{ $baseDir }}/current
    echo "Rolled back to $(find . -maxdepth 1 -name "20*" | sort  | tail -n 2 | head -n1)"
@endtask


@finished
    echo "Envoy deployment complete.\r\n";
@endfinished

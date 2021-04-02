@setup
$repository = "railto/PersonalSite";
$baseDir = "/home/forge/markrailton.com";
$releasesDir = "{$baseDir}/releases";
$currentDir = "{$baseDir}/current";
$newReleaseName = date('Ymd-His');
$newReleaseDir = "{$releasesDir}/{$newReleaseName}";
$user = get_current_user();

function logMessage($message) {
return "echo '\033[32m" .$message. "\033[0m';\n";
}
@endsetup

@servers(['forge@forge.markrailton.com'])

@macro('deploy')
cloneRepository
runComposer
generateAssets
updateSymlinks
optimizeInstallation
updatePermissions
backupDatabase
migrateDatabase
blessNewRelease
cleanOldReleases
finishDeploy
@endmacro

@task('cloneRepository')
{{ logMessage('start cloneRepository') }}
[ -d {{ $releasesDir }} ] || mkdir {{ $releasesDir }};
cd {{ $releasesDir }};

# Create the release dir
mkdir {{ $newReleaseDir }};

# Clone the repo
git clone --depth 1 git@github.com:{{ $repository }} {{ $newReleaseName }}

# Mark release
cd {{ $newReleaseDir }}
echo "{{ $newReleaseName }}" > public/release-name.txt
@endtask

@task('runComposer')
{{ logMessage('start runComposer') }}
cd {{ $newReleaseDir }};
composer install --prefer-dist --no-scripts -q -o;
@endtask

@task('generateAssets', ['on' => 'local'])
{{ logMessage('start generateAssets') }}
npm install &> /dev/null
npm run production &> /dev/null
@endtask


@task('updateSymlinks')
{{ logMessage('start updateSymlinks') }}
# Remove the storage directory and replace with persistent data
rm -rf {{ $newReleaseDir }}/storage;
cd {{ $newReleaseDir }};
ln -nfs {{ $baseDir }}/persistent/storage storage;

# Remove the public/media directory and replace with persistent data
rm -rf {{ $newReleaseDir }}/public/media;
cd {{ $newReleaseDir }};
ln -nfs {{ $baseDir }}/persistent/media public/media;

# Import the environment config
cd {{ $newReleaseDir }};
ln -nfs {{ $baseDir }}/.env .env;
@endtask

@task('optimizeInstallation')
{{ logMessage('start optimizeInstallation') }}
cd {{ $newReleaseDir }};
php artisan clear-compiled;
php artisan optimize;
@endtask

@task('updatePermissions')
{{ logMessage('start updatePermissions') }}
cd {{ $newReleaseDir }};
find . -type d -exec chmod 775 {} \;
find . -type f -exec chmod 664 {} \;
@endtask

@task('backupDatabase')
{{ logMessage('start backupDatabase') }}
cd {{ $currentDir }}
php artisan backup:run
@endtask

@task('migrateDatabase')
{{ logMessage('start migrateDatabase') }}
cd {{ $newReleaseDir }};
php artisan migrate --force;
@endtask

@task('blessNewRelease')
{{ logMessage('start blessNewRelease') }}
ln -nfs {{ $newReleaseDir }} {{ $currentDir }};
cd {{ $newReleaseDir }}
php artisan cache:clear
sudo service php8.0-fpm restart
@endtask

@task('cleanOldReleases')
{{ logMessage('start cleanOldReleases') }}
# Delete all but the 5 most recent.
cd {{ $releasesDir }}
ls -dt {{ $releasesDir }}/* | tail -n +6 | xargs -d "\n" rm -rf;
@endtask

@task('deployOnlyCode',['on' => 'web'])
{{ logMessage('start deployOnlyCode') }}
cd {{ $currentDir }}
git pull origin master
@endtask

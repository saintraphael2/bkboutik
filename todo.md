
# Update project

git pull
composer dumpautoload

# Clear expired password reset tokens
php artisan auth:clear-resets

# Update database with this script:

ALTER TABLE `contrat`
ADD COLUMN `agent`  bigint(11) UNSIGNED NULL DEFAULT NULL AFTER `journalier`,
ADD COLUMN `actif`  tinyint(1) DEFAULT 1 AFTER `agent`;


sauvegarde
/storage/*.key
/.fleet
/.idea
/.vscode
.env
.editorconfig
.phpunit.result.cache
composer.lock
Homestead.json
Homestead.yaml
auth.json
npm-debug.log
yarn-error.log
/vendor
/storage/*
/storage/!.gitignore
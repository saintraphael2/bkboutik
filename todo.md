
# Update project

git pull
composer dumpautoload

# Clear expired password reset tokens
php artisan auth:clear-resets

# Update database with this script:

ALTER TABLE `contrat`
ADD COLUMN `agent`  bigint(11) UNSIGNED NULL DEFAULT NULL AFTER `journalier`,
ADD COLUMN `actif`  tinyint(1) DEFAULT 1 AFTER `agent`;



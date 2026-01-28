# drupal_shared_environment


to create a new drupal core project

You need php and composer. Run these two commands:

`composer create-project drupal/recommended-project sample`

to run drupal project 


`php -d memory_limit=256M web/core/scripts/drupal quick-start demo_umami`


to manually update drupal 


`composer update "drupal/core-*" --with-all-dependencies`
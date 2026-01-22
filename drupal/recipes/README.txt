Recipes allow the automation of Drupal module and theme installation and
configuration.

WHAT TO PLACE IN THIS DIRECTORY?
--------------------------------

Placing downloaded and custom recipes in this directory separates downloaded and
custom recipes from Drupal core's recipes. This allows Drupal core to be updated
without overwriting these files.


# to get started and create a drupal project: 
`composer create-project drupal/recommended-project drupal`

# to run project
`php -d memory_limit=256M web/core/scripts/drupal quick-start demo_umami`
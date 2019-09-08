#INSTALLATION:

1. Add Github repository to composer.json:
    ```Add repository from Github
                {
                    "repositories": [
                        {
                            "type": "vcs",
                            "url":  "git@bitbucket.org:ecolos/sylius-nutrinfo-plugin.git"
                        }
                    ]
                }
    ```
2. Install package via composer from Bitbucket 
    ```console
    composer require ecolos/sylius-nutrinfo-plugin
    ```

3. Add to config/bundles.php
    ```php
            [
                Ecolos\SyliusNutrinfoPlugin\EcolosSyliusNutrinfoPlugin::class => ['all' => true],
                Burgov\Bundle\KeyValueFormBundle\BurgovKeyValueFormBundle::class => ['all' => true],
            ]
    ```

4. Clear the symfony cache
    ```shell script
    php bin/console cache:clear
    ```

5. Determine doctrine schema changes and migrate
    ```shell script
    php bin/console doctrine:migrations:diff
    php bin/console doctrine:migrations:execute --up XXXXXXXXXXXXX
    ```

6. Add to config/services.yaml
    ```yaml
    imports:
      - { resource: "@EcolosSyliusNutrinfoPlugin/Resources/config/config.yml" }
    ```

7. Add to config/routes.yaml
    ```yaml
    ecolos_sylius_nutrinfo_plugin:
        resource: "@EcolosSyliusNutrinfoPlugin/Resources/config/routing.yml"
    ```

8. Add to config/packages/_sylius.yaml
    ```yaml
    imports:
        - { resource: "@EcolosSyliusNutrinfoPlugin/Resources/config/_sylius.yml" }
    ```

9. Add traits to entities

    src/Entity/ProductVariant.php
    ```php
    <?php
    use Ecolos\SyliusNutrinfoPlugin\Entity\NutrinfoVariantTrait;
    class ProductVariant { use NutrinfoVariantTrait; }
    ``` 
    src/Entity/Product.php
    ```php
    <?php
    use Ecolos\SyliusNutrinfoPlugin\Entity\NutrinfoProductTrait;
    class Product { use NutrinfoProductTrait; }
    ``` 
10. Add admin form components

    templates/bundles/SyliusAdminBundle/ProductVariant/Tab/_details.html.twig
    ```twig
    {% form_theme form.nutrinfo '@EcolosSyliusNutrinfoPlugin/Admin/nutrinfo.html.twig' %}
    {{ form_row(form.nutrinfo) }}
    ```
    templates/bundles/SyliusAdminBundle/Product/Tab/_details.html.twig
    ```twig
    {% form_theme form.nutrinfo '@EcolosSyliusNutrinfoPlugin/Admin/nutrinfo.html.twig' %}
    {{ form_row(form.nutrinfo) }}
    ``` 

#USAGE:
Check out the product(-variant) form in the admin section.
A form component will be rendered.

#TODO:
- Add tests

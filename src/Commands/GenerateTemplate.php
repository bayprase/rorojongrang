<?php namespace Rorojongrang\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class GenerateTemplate extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'generate:template';
    protected $description = 'Creates a new template with view and controller files';

    protected $usage       = 'generate:template [template_name]';
    protected $arguments   = [
        'template_name' => 'The name of the template to create',
    ];

    public function run(array $params)
    {
        // Get the template name from the command parameters
        $templateName = $params[0] ?? null;

        // Check if the user has provided a template name
        if (!$templateName) {
            CLI::error('Usage: generate:template [template_name]');
            return;
        }

        // Define paths for the templates and destination files
        $viewTemplate = APPPATH . '../vendor/rorojongrang/bayu-prasetyo/src/Commands/Generators/Views/TemplateDashboard.tpl.php';
        $controllerTemplate = APPPATH . '../vendor/rorojongrang/bayu-prasetyo/src/Commands/Generators/Views/Controller/TemplateController.tpl.php';
        $baseControllerTemplate = APPPATH . '../vendor/rorojongrang/bayu-prasetyo/src/Commands/Generators/Views/Controller/TemplateBaseController.tpl.php';
        $helperTemplate = APPPATH . '../vendor/rorojongrang/bayu-prasetyo/src/Commands/Generators/Views/Helpers/TemplateHelper.tpl.php';
        $routesTemplate = APPPATH . '../vendor/rorojongrang/bayu-prasetyo/src/Commands/Generators/Views/Routes/TemplateRoutes.tpl.php';
        $modelUsersTemplate = APPPATH . '../vendor/rorojongrang/bayu-prasetyo/src/Commands/Generators/Views/Models/M_Users.tpl.php';
        $modelInventoryTemplate = APPPATH . '../vendor/rorojongrang/bayu-prasetyo/src/Commands/Generators/Views/Models/M_Inventory.tpl.php';
        $modelDistibutionTemplate = APPPATH . '../vendor/rorojongrang/bayu-prasetyo/src/Commands/Generators/Views/Models/M_Distribution.tpl.php';

        $viewDestinationPath = APPPATH . 'Views/' . $templateName . '.php';
        $controllerDestinationPath = APPPATH . 'Controllers/' . $templateName . '.php';
        $baseControllerDestinationPath = APPPATH . 'Controllers/BaseController.php';
        $helperDestinationPath = APPPATH . 'Helpers/' . $templateName . '_helper.php';
        $routesDestinationPath = APPPATH . 'Config/Routes.php';
        $m_UsersDestinationPath = APPPATH . 'Models/M_Users.php';
        $m_InventoryDestinationPath = APPPATH . 'Models/M_Inventory.php';
        $m_DistributionDestinationPath = APPPATH . 'Models/M_Distribution.php';

        // Check if the view template already exists
        if (file_exists($viewDestinationPath) || file_exists($controllerDestinationPath)) {
            CLI::error("Template '{$templateName}' already exists.");
            return;
        }

        // Create the view file
        $this->generateFile($viewTemplate, $viewDestinationPath, ['{{templateName}}' => $templateName]);
        
        // Create the controller file
        $this->generateFile($controllerTemplate, $controllerDestinationPath, ['{{templateName}}' => $templateName]);
        $this->generateFile($helperTemplate, $helperDestinationPath, ['{{templateName}}' => $templateName]);
        $this->generateFile($baseControllerTemplate, $baseControllerDestinationPath, ['{{templateName}}' => $templateName]);
        $this->generateFile($routesTemplate, $routesDestinationPath, ['{{templateName}}' => $templateName]);
        $this->generateFile($modelUsersTemplate, $m_UsersDestinationPath, ['{{templateName}}' => $templateName]);
        $this->generateFile($modelInventoryTemplate, $m_InventoryDestinationPath, ['{{templateName}}' => $templateName]);
        $this->generateFile($modelDistibutionTemplate, $m_DistributionDestinationPath, ['{{templateName}}' => $templateName]);

        CLI::write("Files for template '{$templateName}' created successfully!", 'green');
    }

    /**
     * Generates a file from a template with replacements.
     *
     * @param string $templatePath
     * @param string $destinationPath
     * @param array $placeholders
     */
    private function generateFile(string $templatePath, string $destinationPath, array $placeholders)
    {
        // Load the template content
        $templateContent = file_get_contents($templatePath);
        
        // Replace placeholders in the template content
        $newContent = str_replace(array_keys($placeholders), array_values($placeholders), $templateContent);

        // Write the generated content to the destination file
        if (write_file($destinationPath, $newContent)) {
            CLI::write("File created at: {$destinationPath}", 'green');
        } else {
            CLI::error("Error creating file at {$destinationPath}");
        }
    }
}

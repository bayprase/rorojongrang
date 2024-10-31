<?php namespace Rorojongrang\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class GenerateTemplateAdd extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'generate:crud_add';
    protected $description = 'Create a new file template CRUD (Create)';

    protected $usage       = 'generate:crud_add [file_name]';
    protected $arguments   = [
        'file_name' => 'The name of the file create view create',
    ];

    public function run(array $params)
    {
        // Get the template name from the command parameters
        $viewsName = $params[0] ?? null;

        // Check if the user has provided a template name
        if (!$viewsName) {
            CLI::error('Usage: '.$this->usage);
            return;
        }

        // Define the paths for the template and the destination HTML file
        $templatePath = APPPATH . 'ThirdParty/Rorojongrang/src/Commands/Generators/Views/TemplateAdd.tpl.php';
        $destinationPath = APPPATH . 'Views/' . $viewsName . '.php';

        // Check if the template already exists
        if (file_exists($destinationPath)) {
            CLI::error("Template '{$viewsName}' already exists.");
            return;
        }

        // Load the content of the template file
        $templateContent = file_get_contents($templatePath);

        // Replace placeholders in the template content with actual values
        $newTemplateContent = str_replace(
            '{{viewsName}}',
            $viewsName,
            $templateContent
        );

        // Write the generated content to the destination HTML file
        if (write_file($destinationPath, $newTemplateContent)) {
            CLI::write("Template '{$viewsName}' created successfully!", 'green');
            CLI::write("Path: {$destinationPath}");
        } else {
            CLI::error("Error creating template '{$viewsName}'.");
        }
    }

    
}

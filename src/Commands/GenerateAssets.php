<?php 

namespace Rorojongrang\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class GenerateAssets extends BaseCommand
{
    protected $group       = 'Custom'; // Command group
    protected $name        = 'generate:assets'; // Command name in Spark
    protected $description = 'Copies assets from Rorojongrang to the public directory'; // Command description

    public function run(array $params)
    {
        // Define the source and destination paths
        $sourcePath      = APPPATH . '../vendor/rorojongrang/bayu-prasetyo/src/assets';
        $destinationPath = FCPATH . 'assets/Rorojongrang';

        // Check if source exists
        if (!is_dir($sourcePath)) {
            CLI::error('Source path does not exist: ' . $sourcePath);
            return;
        }

        // Create the destination directory if it doesn't exist
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Run xcopy command (for Windows)
        $xcopyCommand = 'xcopy "' . $sourcePath . '" "' . $destinationPath . '" /E /I /Y';
        CLI::write('Running: ' . $xcopyCommand);
        $output = shell_exec($xcopyCommand);

        if ($output) {
            CLI::write('Assets copied successfully!', 'green');
        } else {
            CLI::error('Failed to copy assets.');
        }
    }
}

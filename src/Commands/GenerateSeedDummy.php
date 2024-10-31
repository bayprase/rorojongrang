<?php namespace Rorojongrang\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class GenerateSeedDummy extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'generate:dummy';
    protected $description = 'Creates a new dynamic database seeder from a template';

    protected $usage       = 'generate:dummy [seeder_name] --table [table_name] --fields [field1:value1,field2:value2]';
    protected $arguments   = [
        'seeder_name' => 'The name of the seeder to create',
    ];

    protected $options = [
        '--table'  => 'The name of the table to insert data into',
        '--fields' => 'The fields and values in "field:value" format, separated by commas, or a single number for field count',
    ];

    public function run(array $params){
        $seederName = $params[0] ?? null;

        $tableName = CLI::getOption('table');
        $fieldsOption = CLI::getOption('fields');

        if (!$seederName || !$tableName || !$fieldsOption) {
            CLI::error('You must provide a seeder name, table name, and fields.');
            CLI::error('Usage: generate:dummy [seeder_name] --table [table_name] --fields [field1:value1,field2:value2] or a number of fields.');
            return;
        }

        $fields = [];
        if (is_numeric($fieldsOption)) {
            for ($i = 1; $i <= (int)$fieldsOption; $i++) {
                $fields[$i] = [
                    'field1' => 'field'.$i,
                    'field2' => 'field'.$i+1,
                    'field3' => 'field'.$i+2,
                    'field4' => 'field'.$i+3,
                    'field5' => 'field'.$i+4,
                ];
            }
        } else {
            $fields = $this->parseFields($fieldsOption);
        }

        $fieldsString = $this->buildFieldsString($fields);

        $templatePath = APPPATH . 'ThirdParty/Rorojongrang/src/Commands/Generators/Views/DummySeed.tpl.php';
        $destinationPath = APPPATH . 'Database/Seeds/' . $seederName . '.php';

        if (file_exists($destinationPath)) {
            CLI::error("Seeder '{$seederName}' already exists.");
            return;
        }

        $templateContent = file_get_contents($templatePath);
        $newSeederContent = str_replace(
            ['{{seederName}}', '{{tableName}}', '{{fields}}'],
            [$seederName, $tableName, $fieldsString],
            $templateContent
        );

        if (write_file($destinationPath, $newSeederContent)) {
            CLI::write("Seeder '{$seederName}' created successfully!", 'green');
            CLI::write("Path: {$destinationPath}");
        } else {
            CLI::error("Error creating seeder '{$seederName}'.");
        }
    }

    protected function parseFields(string $fieldsOption): array{
        $fields = [];
        $pairs = explode(',', $fieldsOption);
        foreach ($pairs as $pair) {
            $pair = trim($pair);
            if (strpos($pair, ':') !== false) {
                [$field, $value] = explode(':', $pair);
                $fields[trim($field)] = trim($value);
            }
        }
        return $fields;
    }

    protected function buildFieldsString(array $fields): string{
        $fieldsString = '';
        foreach ($fields as $field => $value) {
            if (is_array($value)) {
                $fieldsString = "[\n";
		        foreach ($fields as $value) {
		            $fieldsString .= "\t\t\t[\n";
		            foreach ($value as $subField => $subValue) {
		                $fieldsString .= "\t\t\t\t'{$subField}' => '{$subValue}',\n";
		            }
		            $fieldsString .= "\t\t\t],\n";
		        }
		        $fieldsString .= "\t\t];";
            } else {
                $fieldsString .= "[\n";
                $fieldsString .= "\t\t\t[\n";
                foreach ($fields as $idx => $dd) {
                	$fieldsString .= "\t\t\t\t'{$idx}' => '{$dd}',\n";
                }
                $fieldsString .= "\t\t\t],\n";
                $fieldsString .= "\t\t];\n";
                break;
            }
        }
        return rtrim($fieldsString, ",\n");
    }
}

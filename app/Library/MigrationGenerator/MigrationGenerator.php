<?php

namespace App\Library\MigrationGenerator;

use File;
use Schema;
use Artisan;

/**
 * Class Module Generator.
 *
 * @author Anuj Jaha
 */
class MigrationGenerator
{
    public function __construct()
    {
    }
    
    /**
     * Get Migration Template
     * 
     * @param Object $inputTable
     * @param collection $inputFields
     */
    public function getMigrationTemplate($inputTable, $inputFields)
    {
        $html = <<<EOD
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTable###Tablename###MigrationFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('###tablename###', function (Blueprint ##$##table) {
EOD;
    $html .= "\n\t\t\t";
            foreach($inputFields as $inputF)
            {
                $html = $html . $this->getInputTemplate($inputF) . " \n\t\t\t";
            }
            
            $html = $html .  <<<EOD
##$##table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('###tablename###');
    }
}
EOD;
        $html = str_replace('###Tablename###', ucfirst(camel_case($inputTable->title)), $html);
        $html = str_replace('###tablename###', $inputTable->title, $html);
        $html = str_replace('##$##', '$', $html);
        return $html;
    }

    /**
     * Generate Migration File
     * 
     * @param Object $table
     * @param Collection $tableFields
     * @return bool
     */
    public function generateMigrationFile($table, $tableFields)
    {
        Artisan::call('make:migration create_table_' . $table->notes);
        $migrationPath = 'database/migrations';

        $migratePath = base_path().DIRECTORY_SEPARATOR.$migrationPath;
        $allFiles = scandir($migratePath, SCANDIR_SORT_DESCENDING);
        //$fileName = "auto_" . date("Y_m_d_his") . '_' . $table->notes . '.php';
       // $file = $migratePath.DIRECTORY_SEPARATOR.$fileName;
        $file = $allFiles[0];
        $content = $this->getMigrationTemplate($table, $tableFields);

        // if (! is_writable($migratePath)) {
        //     // Change Folder Permission
        //     chmod($migratePath, 0755);
        // }
        
        //$status = File::put($file, $content);
        if(file_put_contents( $migratePath . DIRECTORY_SEPARATOR .$file, $content))
        {
            chmod($migratePath . DIRECTORY_SEPARATOR .$file, 0777);
            return $file;
        }
        
        // if ($status) {
        //     chmod($file, 0777);

        //     return true;
        // }

        return false;
    }

    /**
     * Get Input Template
     * 
     * @param Object $input
     * @return string
     */
    public function getInputTemplate($input)
    {
        if($input->is_primary_field == 1)
        {
            return "\t##$##table->bigIncrements('". $input->field_name ."');";
        }

        $isNullable = '';
        $isIndex    = '';
        $isUnique   = '';
        $isDefault  = '';
        $isSoftDelete = '';

        if($input->is_nullable == 1)
        {
            $isNullable = '->nullable()';
        }

        if($input->is_index_field == 1)
        {
            $isIndex = '->index()';
        }

        if($input->is_unique_field == 1)
        {
            $isUnique = '->unique()';
        }

        if($input->is_soft_delete == 1)
        {
            $isSoftDelete = '->nullable()->default(null)';
        }

        if(
            $input->is_soft_delete == 0
            &&
            isset($input->default_value) 
            &&
            !empty($input->default_value))
        {
            $isDefault = '->default("'. $input->default_value .'")';
        }

        $postString = $isNullable . $isIndex . $isUnique . $isDefault; 
        
        switch($input->field_type)
        {
            case 'int':
                return "##$##table->integer('". $input->field_name ."')". $postString .";";
            
            case 'float':
                return "##$##table->float('". $input->field_name ."', 10 , 3)". $postString .";";

            case 'date':
                    return "##$##table->date('". $input->field_name ."')". $postString .";";

            case 'longText':
                return "##$##table->longText('". $input->field_name ."')". $postString .";";
            
            case 'string':
                return "##$##table->string('". $input->field_name ."')". $postString .";";
            
            case 'timestamp':
                return "##$##table->timestamp('". $input->field_name ."')". $postString .";";
            
            case 'datetime':
                    return "##$##table->datetime('". $input->field_name ."')". $postString .";";
            
            default: 
                return "##$##table->string('". $input->field_name ."')". $postString .";";
            break;
        }
    }
}

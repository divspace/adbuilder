<?php namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProductSearch extends Command {

    public $file = '../../Divspace/productfinder/data/afm.txt';

    protected $signature = 'product:search
                            {query? : Space separated keywords to match against}
                            {--f|file : Read one or more newline separated patterns from file}
                            {--i|ignore-case : Perform case insensitive matching}';

    protected $description = 'Search the AFM product list';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        $command = null;

        if(!file_exists($this->file)) {
            $this->line("\n");
            $this->error('                              ');
            $this->error('  Image file does not exist.  ');
            $this->error('                              ');
            $this->line("\n");

            return;
        }

        $query = $this->argument('query');

        if(is_null($query)) {
            $query = $this->ask('What are you looking for');
        }

        $file = ($this->option('file')) ?: $this->file;
        $case = ($this->option('ignore-case')) ? ' -i' : '';

        $words = explode(' ', $query);

        foreach($words as $word) {
            if(is_null($command)) {
                $command = 'grep'.$case.' "'.$word.'" '.$file;
            } else {
                $command = $command.' | grep'.$case.' "'.$word.'"';
            }
        }

        exec($command, $result);

        foreach($result as $i => $filepath) {
            $this->line(' '.++$i.') '.basename($filepath));
        }

        $imageCount = count($result);

        $this->warn("\n".' '.$imageCount.' results found for "'.$query.'"');

        if($imageCount > 0) {
            $number = $this->ask('Enter the number of the image you would like to view');

            $isValid = false;

            while(!$isValid) {
                if(is_numeric($number) && isset($result[--$number])) {
                    $isValid = true;
                } else {
                    $number = $this->ask('Invalid number. Please try again');
                }
            }

            $path = preg_replace('/\s/', '\ ', $result[$number]);

            $this->warn('Opening image...'."\n");

            exec('open '.$path);
        }
    }

}

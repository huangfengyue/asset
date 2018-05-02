
<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AccountRole;

class Repay extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'repay:send';
    private $UserRole;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '���ǻ����б���µ�����.';
$signature ="repay";
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->UserRole = new AccountRole();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data["role_id"] = 7;
            $data["role_name"] = "haha";
            $data["create_time"] = "123456";
            $data["role_desc"] = "3532532";
            $data["status"] = "1";
            return $this->UserRole->insertGetId($data);
    }

}

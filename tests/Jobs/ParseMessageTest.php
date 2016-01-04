<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 12/30/15
 * Time: 3:07 PM
 */

use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Jobs\ParseMessage;
use App\Models\User;

class ParseMessageTest extends TestCase{
    use DispatchesJobs;

    public function testHandle(){
        $user = User::find(1);
        $message = '[l giraffes l] hey there boys [l big penis l] what do you feel like doing [l tonight l] [p penis p]';
        $ret = $this->dispatch(new ParseMessage($user, $message));
        $this->assertTrue($ret);
    }

}
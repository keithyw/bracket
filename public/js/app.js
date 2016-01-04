/**
 * Created by keithwatanabe on 12/31/15.
 */

Pusher.log = function(message) {
    if (window.console && window.console.log) {
        window.console.log(message);
    }
};

var pusher = new Pusher('a465bf31c05983004c18', {
    encrypted: true
});
var channel = pusher.subscribe('message_channel');
channel.bind('process_link', function(data) {
    alert(data.message);
});

//$this->_pusher->trigger('message_channel', 'process_link', $data);

import MessageActions from 'actions/MessageActions';

let messages = ['test1', 'test2', 'test3'];

export default {
    fetchMessages: {
        remote(){
            console.log('promise');
            return new Promise(function (resolve, reject) {
                setTimeout(function () {
                    if (true) {
                        console.log('resolving');
                        resolve(messages);
                    } else {
                        reject('dead');
                    }
                }, 250);
            });
        },
        local(){
            return null;
        },
        shouldFetch(){
            return true;
        },
        loading: MessageActions.fetchMessages,
        success: MessageActions.updateMessages,
        error: MessageActions.messagesFailed
    }
}
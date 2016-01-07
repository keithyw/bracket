import flux from 'control';


class MessageActions {

    fetchMessages(){
        this.dispatch();
        /**
        return (dispatch) => {
            dispatch();
            let messages = ['test1', 'test2', 'test3'];
            console.log("updating messages");
            this.updateMessages(messages);
        }
         */
    }

    messagesFailed(data){
        this.dispatch(data);
        return data;
    }

    updateMessage(data){
        this.dispatch(data);
        return data;
    }

    updateMessages(data) {
        console.log('trying to dispatch');
        this.dispatch(data);
        return data;
    }
}

export default flux.createActions(MessageActions);
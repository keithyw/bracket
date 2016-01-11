import flux from 'control';


class MessageActions {

    fetchMessages(){
        this.dispatch();
    }

    messagesFailed(data){
        this.dispatch(data);
        return data;
    }

    fixMessage(data){
        this.dispatch(data);
        //return data;
    }

    updateMessage(data){
        this.dispatch(data);
        //return data;
    }

    updateMessages(data) {
        this.dispatch(data);
        //return data;
    }
}

export default flux.createActions(MessageActions);
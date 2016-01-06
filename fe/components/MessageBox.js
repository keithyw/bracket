import React from 'react';
import connectToStores from 'alt/utils/connectToStores';
import MessageForm from 'components/MessageForm';
import MessageList from 'components/MessageList';
import MessageStore from 'stores/MessageStore';
import MessageActions from 'actions/MessageActions';

@connectToStores
export default class MessageBox extends React.Component {
    constructor(props){
        super(props);
        MessageStore.fetchMessages();
    }
    
    static getStores(props){
        return [MessageStore];
    }

    static getPropsFromStores(props){
        return MessageStore.getState();
    }

    render(){

        return (
            <div>
                <MessageForm/>
                <MessageList messages={this.props.messages}/>
            </div>
        );
    }
}
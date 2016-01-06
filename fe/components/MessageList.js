import React from 'react';
import connectToStores from 'alt/utils/connectToStores';
import Message from 'components/Message';
import MessageStore from 'stores/MessageStore';
import MessageActions from 'actions/MessageActions';

@connectToStores
export default class MessageList extends React.Component {
    constructor(props){
        super(props);
        MessageActions.fetchMessages();
        /**
        this.state = {
            messages: this.props.messages ? this.props.messages : []
        }
        */
        //AuctionStore.fetchAuctionIndex();
    }

    static getStores(){
        return [MessageStore];
    }

    static getPropsFromStores(){
        return MessageStore.getState();
    }



    render(){
        return (
            <ul>
            {this.props.messages.map((message, i) => {
                return (
                    <li key={i}>
                        <Message message={message}/>
                    </li>
                )
            })}
            </ul>
        );
    }
}
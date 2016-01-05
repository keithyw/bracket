import React from 'react';
import Message from 'components/Message';

export default class MessageList extends React.Component {
    constructor(props){
        super(props);
        this.state = {
            messages: this.props.messages ? this.props.messages : []
        }
    }

    render(){
        return (
            <ul>
            {this.state.messages.map((message, i) => {
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
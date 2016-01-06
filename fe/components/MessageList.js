import React from 'react';
import Message from 'components/Message';

export default class MessageList extends React.Component {
    constructor(props){
        super(props);
        console.log(props);
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
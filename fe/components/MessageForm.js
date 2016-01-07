import React from 'react';
import MessageActions from 'actions/MessageActions';
import MessageStore from 'stores/MessageStore';

export default class MessageForm extends React.Component {
    constructor(props){
        super(props);
    }

    onClick(e) {
        e.preventDefault();
        let form = document.forms.message_form;
        this.setState({message: form.message.value});
        MessageStore.saveMessage(form.message.value);
        //MessageActions.saveMessage(form.message.value);
    }

    render(){
        return (
            <form name="message_form" action="" method="">
                <div>
                    <textarea name="message" placeholder="Enter your message here"/>
                </div>
                <div>
                    <input type="submit" value="Save" onClick={this.onClick.bind(this)}/>
                </div>
            </form>
        );
    }
}
import React from 'react';
import MessageStore from 'stores/MessageStore';
import MessageActions from 'actions/MessageActions';

export default class MessageForm extends React.Component {
    constructor(props){
        super(props);
        this.state = {
            message: props.message
        }
    }

    static getStores(props){
        return [MessageStore];
    }

    static getPropsFromStores(props){
        return MessageStore.getState();
    }

    onClick(e) {
        let form = document.forms.message_form;
        this.setState({message: form.message.value});
        MessageActions.updateMessage(form.message.value);
        alert("message " + form.message.value);
        return false;
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
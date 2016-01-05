import React from 'react';

export default class MessageForm extends React.Component {
    render(){
        return (
            <form action="" method="">
                <div>
                    <textarea name="message" placeholder="Enter your message here"/>
                </div>
                <div>
                    <input type="submit" value="Save"/>
                </div>
            </form>
        );
    }
}
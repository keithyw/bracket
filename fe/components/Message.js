import React from 'react';

export default class Message extends React.Component {
    constructor(props){
        super(props);
        this.state = {
            message: props.message
        }
    }

    render(){
        return (
            <span>
                {this.state.message}
            </span>
        );
    }
}
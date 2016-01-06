import React from 'react';
import {RouteHandler, Link} from 'react-router';
import MessageForm from 'components/MessageForm';
import MessageList from 'components/MessageList';

class Main extends React.Component {
    render() {

        let messages = ['test1', 'test2', 'test3'];
        return (
            <div>
                <h1>[[Bracket]]</h1>
                <MessageForm/>
                <MessageList/>
            </div>
        );
    }
}

export default Main;
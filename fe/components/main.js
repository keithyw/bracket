import React from 'react';
import {RouteHandler, Link} from 'react-router';
import MessageForm from 'components/MessageForm';

class Main extends React.Component {
    render() {
        return (
            <div>
                <h1>[[Bracket]]</h1>
                <MessageForm/>
            </div>
        );
    }
}

export default Main;  
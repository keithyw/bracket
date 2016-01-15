import React from 'react';
import {RouteHandler, Link} from 'react-router';
import MessageBox from 'components/MessageBox';

class Main extends React.Component {
    render() {

        let messages = ['test1', 'test2', 'test3'];
        return (
            <div id="main">
                <h1>[[Bracket]]</h1>
                <MessageBox/>
            </div>
        );
    }
}

export default Main;
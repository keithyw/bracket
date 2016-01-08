import React from 'react';

class VideoPartial extends React.Component {
    constructor(props){
        super(props);
    }

    render(){
        let url = 'http://www.youtube.com/embed/' + this.props.videoId;
        return(
            <iframe type="text/html" width="640" height="480" src={url} frameBorder="0"></iframe>
        );
    }
}

export default class Message extends React.Component {
    constructor(props){
        super(props);
        this.state = {
            message: props.message.message,
            raw_results: props.message.raw_results
        }
    }

    render(){
        let items = this.state.message.split(/\s+/);
        let reg = /^\|(\d+)\|$/;
        let arr = [];
        let ret = null;
        if (this.state.raw_results){
            // need to create different components per situation
            // so figure out the type then map that to a component for rendering.
            ret = items.map((txt) => {
                arr.push(txt);
                if (reg.test(txt)){
                    let id = txt.substring(1, txt.length -1);
                    if (this.state.raw_results[id]){
                        let results = this.state.raw_results[id].results

                        return(<VideoPartial videoId={results[0].id}/>);
                    }
                }
                return (txt);
            });
        }
        if (arr.length > 0 ){
            return(
                <span>
                    {ret}
                </span>
            );
        }
        return (
            <span>
                {this.state.message}
            </span>
        );
    }
}
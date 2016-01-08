import React from 'react';

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
        if (this.state.raw_results){
            items.map((txt) => {
                if (reg.test(txt)){
                    let id = txt.substring(1, txt.length -1);
                    if (this.state.raw_results[id]){
                        txt = this.state.raw_results[id][0].image_default;
                    }
                    //console.log("id " + id);
                }
                arr.push(txt);
                //console.log("txt " + txt);
            });
        }
        let str = arr.length > 0 ? arr.join(' ') : this.state.message;
        return (
            <span>
                {str}
            </span>
        );
    }
}
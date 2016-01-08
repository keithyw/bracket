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
        let ret = null;
        if (this.state.raw_results){
            ret = items.map((txt) => {
                arr.push(txt);
                if (reg.test(txt)){
                    let id = txt.substring(1, txt.length -1);
                    if (this.state.raw_results[id]){
                        //txt = this.state.raw_results[id][0].image_default;
                        let url = 'http://www.youtube.com/embed/' + this.state.raw_results[id][0].id;
                        let src = this.state.raw_results[id][0].image_default;
                        //return (<img src={src}/>);
                        return(<iframe type="text/html" width="640" height="390" src={url} frameBorder="0"></iframe>);
                    }
                }
                return (txt);
            });
            console.log(ret);
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

/**
<iframe id="ytplayer" type="text/html" width="640" height="390"
    src="http://www.youtube.com/embed/M7lc1UVf-VE?autoplay=1&origin=http://example.com"
    frameborder="0"/>
 */
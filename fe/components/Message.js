import React from 'react';
import ReactDOM from 'react-dom';
import GoogleMap from 'google-map-react';

class LinkPartial extends React.Component {
    constructor(props){
        super(props);
    }

    render(){
        return(
            <a href="">test</a>
        );
    }
}

class GiphyPartial extends React.Component {
    constructor(props){
        super(props);
    }

    render(){
        return(
            <div>
                <img src={this.props.image}/>
            </div>
        );
    }
}

class MapPartial extends React.Component {
    constructor(props){
        super(props);

    }

    render(){
        return (
            <div className="maps">
                <GoogleMap defaultZoom={10} defaultCenter={{lat: this.props.lat, lng: this.props.lng}} bootstrapURLKeys={{ key: 'AIzaSyDMAbkcAVqq-Ij4HrlKU7KkUUnzwA1qw2w'}}>
                    <div lat={this.props.lat} lng={this.props.lng}>Here</div>
                </GoogleMap>
            </div>
        );
    }
}

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
/**
* [l l] -> search link
* [i i] -> image
* [g g] -> animated gif
* [p p] -> preview
* [v v] -> video
* [t t] -> twitter
 */

export default class Message extends React.Component {
    constructor(props){
        super(props);
        this.state = {
            message: props.message.message,
            raw_results: props.message.raw_results
        }
    }

    render(){
        let items = this.props.message.message.split(/\s+/);
        let reg = /^\|(\d+)\|$/;
        let arr = [];
        let ret = null;
        if (this.props.message.raw_results){
            // need to create different components per situation
            // so figure out the type then map that to a component for rendering.
            ret = items.map((txt, i) => {
                arr.push(txt);
                if (reg.test(txt)){
                    let id = txt.substring(1, txt.length -1);
                    if (this.props.message.raw_results[id]){
                        let results = this.props.message.raw_results[id].results
                        switch (this.props.message.raw_results[id].type){
                            case 'giphy':
                                return(<GiphyPartial image={results[0].url}/>);
                            case 'video':
                                return(<VideoPartial videoId={results[0].id} key={i}/>);
                            case 'map':
                                let lng = results[0].geometry.location.lng;
                                let lat = results[0].geometry.location.lat;
                                return(<MapPartial lng={lng} lat={lat} key={i}/>);
                        }
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
                {this.props.message}
            </span>
        );
    }
}
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

//http://us.battle.net/d3/static/js/tooltips.js

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

class InstagramPartial extends React.Component {
    constructor(props){
        super(props);
    }

    render(){
        return (
            <div>
                <a href={this.props.url}>
                    <img src={this.props.image.url}/>
                </a>
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

class MoviePartial extends React.Component {
    constructor(props){
        super(props);
    }

    render(){
        let url = `http://www.imdb.com/title/${this.props.movie}`;
        return (
            <div>
                <a href={url} target="_blank">
                    <p>
                        <img src={this.props.image}/>
                    </p>
                    <h3>{this.props.title} ({this.props.year})</h3>
                </a>
            </div>
        );
    }
}

class TwitchPartial extends React.Component {
    constructor(props){
        super(props);
    }

    render(){
        let url = `http://player.twitch.tv/?channel=${this.props.channel}`;
        let chat = `http://www.twitch.tv/${this.props.channel}/chat?=popout=`;
        return (
            <div>
                <iframe src={url} frameborder="0" scrolling="no" height="378" width="620">
                </iframe>
                <iframe src={chat} frameborder="0"scrolling="no" height="378" width="350">
                </iframe>
            </div>
        );
    }
}
class TwitterPartial extends React.Component {
    constructor(props){
        super(props);
    }

    componentDidMount(){
        twttr.widgets.load();
    }

    render(){
        let url = 'https://twitter.com/' + this.props.user + '/status/' + this.props.twitter_id;
        return (
            <div>
                <blockquote className="twitter-tweet"><a href={url}>{this.props.text}</a></blockquote>
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
            <div className="youtube">
            <iframe type="text/html"  src={url} frameBorder="0"></iframe>
                </div>
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
                                return(<GiphyPartial image={results[0].url} key={i}/>);
                            case 'instagram':
                                return(<InstagramPartial image={results[0].image} url={results[0].url} key={i}/>);
                            case 'movie':
                                return(<MoviePartial movie={results[0].imdbID} image={results[0].image} title={results[0].Title} year={results[0].Year} key={i}/>);
                            case 'twitch':
                                return(<TwitchPartial channel={results} key={i}/>);
                            case 'twitter':
                                return(<TwitterPartial twitter_id={results[0].id} user={results[0].user} text={results[0].text} key={i}/>);
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
/*
1-write npm init to create the file pakage.json and enter the info
2-write command "npm install express --save" --save to save it in package.json
2-write command "npm install http --save" --save to save it in package.json
2-write command "npm install socket.io --save" --save to save it in package.json
2-write command "npm install nodemon --save-dev" --save to save it in package.json
2-write command "npm install socket.io -g" -g to install it global
*/

'user strict';

const express = require("express");
const http = require("http");
const socket = require("socket.io");
const SocketServer=require("./socket");//because its file must put ./ before its name
//then SocketServer=module that socket.js export (Socket class)


class Server {
    constructor(){
        this.port=5000;
        this.host='localhost';

        this.app=express();
        this.http=http.Server(this.app);//Server(express)
        this.socket=socket(this.http);
    }

    runServer()
    {

        new SocketServer(this.socket).socketConnection();

        this.http.listen(this.port,this.host,()=>{
            console.log(`server is running at http://${this.host}:${this.port}`);
        });
    }
}

const app = new Server();

app.runServer();
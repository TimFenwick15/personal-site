require('dotenv').config() // pull in env vars from .env file. TESTING ONLY
const express = require('express');
const app = express();
//const bodyParser = require('body-parser')
//app.use(express.static('./web'));
//app.use(bodyParser.urlencoded({extended: false})); 

const mysql = require('mysql')
const config = {
  host     : process.env.DB_HOST,
  user     : process.env.DB_USERNAME,
  password : process.env.DB_PASSWORD,
  database : process.env.DB_DATABASE
}

const pool = mysql.createPool(config)
pool.getConnection((err, connection) => {
  connection.query('SELECT * from data', function (error, results, fields) {
    // again, this may return an empty result set instead of erroring
    // Also, this really should be in its own db, not just its own table within 'my' db
    if (error) {
      connection.query(
        'CREATE TABLE data (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255), value VARCHAR(255), unit VARCHAR(255), time_updated DATETIME',
        createErr => console.error
      )
    }
  })
})

app.get('/data', (req, res) => {
  pool.getConnection((err, connection) => {
    connection.query(`SELECT * from data WHERE name=${req.params.name}`, function (error, results, fields) {
      if (error) {
        console.error('DB err: ' + error)
        res
          .status(500)
          .send()
        throw new Error()
      }
      res
        .status(200)
        .send('hello')
    })
  })
})

app.post('/data', (req, res) => {
  if (!(req.body.name && req.body.value && req.body.unit && req.body.time)) {
    console.error('Bad post :' + req.body)
    res
      .status(500)
      .send()
    throw new Error()
  }
  pool.getConnection((err, connection) => {
    connection.query(`SELECT * from data WHERE name=${req.body.name}`, (error, results) => {
      // This would swallow ligitimate errors. Would this error or return an empty result set?
      if (error) {
        // write an insert query
        connection.query(`SELECT * from data WHERE name=${req.body.name}`, (error, results) => {
        })
      }
      else {
        // write an update query
        connection.query(`SELECT * from data WHERE name=${req.body.name}`, (error, results) => {
        })
      }
      res
        .send('hello')
    })
  })
})
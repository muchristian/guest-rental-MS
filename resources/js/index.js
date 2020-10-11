import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router } from 'react-router-dom';
import { composeWithDevTools } from 'redux-devtools-extension';
import { Provider } from 'react-redux';
import { createStore, applyMiddleware, combineReducers } from 'redux';
import thunk from 'redux-thunk';
// import App component
import App from './components/App';


//const rootReducers = combineReducers({});

//const store = createStore(null, composeWithDevTools(applyMiddleware(thunk)))
// change the getElementId from example to app 
// render App component instead of Example
const rootRouter = (
    //<Provider store={store}>
    <Router basename='/'>
      <App />
    </Router>
    //</Provider>
  );
if (document.getElementById('root')) {
    ReactDOM.render(
        rootRouter
    , document.getElementById('root'));
}
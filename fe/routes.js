/**
 * Created by keithwatanabe on 1/5/16.
 */
import React from 'react';
import {Route} from 'react-router';

import Main from 'components/main';

//import Example from 'components/example';

const routes = (
    <Route path="/" component={Main}>
        <div>blorf</div>
    </Route>
);

export default routes;
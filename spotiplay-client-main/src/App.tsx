import "@fontsource/rubik";

import { BrowserRouter as Router, Route, Switch } from "react-router-dom";
import Navbar from "./Navbar";
import { ChakraProvider, CSSReset } from "@chakra-ui/react";
import Podcaster from "./pages/Podcaster";
import ProducedPodcast from "./pages/ProducedPodcast";
import PodcasterList from "./pages/PodcasterList";
import PodcastReview from "./pages/PodcastReview";

import theme from "./theme";
import Register from "./pages/Register";
import Login from "./pages/Login";
import Subscriptions from "./pages/Subscriptions";
import Unauthorized from "./pages/Unauthorized";
import NotFound from "./pages/NotFound";

function App() {
  return (
    <>
      <ChakraProvider theme={theme}>
        <CSSReset />
        <Router>
          <div className="App">
            <Switch>
              <Route exact path="/" component={Login} />
              <Route exact path="/login" component={Login} />
              <Route exact path="/register" component={Register} />
              <Route exact path="/unauthorized" component={Unauthorized} />
              <Route exact path="/notfound" component={NotFound} />
              <Route path="*" component={NotFound} />
              <Route>
                <Navbar />
                <div className="content">
                  <Switch>
                    <Route exact path="/register">
                      <Register />
                    </Route>
                    <Route exact path="/login">
                      <Login />
                    </Route>
                    <Route exact path="/edit-podcast/:id">
                      <ProducedPodcast />
                    </Route>
                    <Route exact path="/podcaster">
                      <PodcasterList />
                    </Route>
                    <Route exact path="/podcaster/:id">
                      <Podcaster />
                    </Route>
                    <Route exact path="/podcast-review/:podcast_id/:reviewer_id?">
                      <PodcastReview />
                    </Route>
                    <Route exact path="/subscriber/:podcaster_id">
                      <Subscriptions />
                    </Route>
                  </Switch>
                </div>

              </Route>
            </Switch>
          </div>
        </Router>
      </ChakraProvider>
    </>
  );
}

export default App;

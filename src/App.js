import logo from './logo.svg';
import './App.css';
import FadeMenu from './components/menubar';
import ResponsiveAppBar from './components/menubar';
import Calculator from './components/calculator';
import resume from './components/resume';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import ResumeBuild from './components/resume';
function App() {
  return (
    <div className="App">
      <ResponsiveAppBar></ResponsiveAppBar>
      <BrowserRouter>
        <Routes>
          <Route path="/"/>
          <Route path="/calculator" element={<Calculator />} />
          <Route path="/resume" element={<ResumeBuild />} />

        </Routes>

      </BrowserRouter>
    </div>
  );
}

export default App;

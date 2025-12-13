import { Route, Routes } from 'react-router-dom'
import './App.css'
import Layout from './components/layout/layout'
import Login from './pages/login/login'
import Registration from './pages/registration/registration'
import Weapons from './pages/weapons/weapons'
import Armor from './pages/armor/armor'
import Characters from './pages/characters/characters'

function App() {
  return (
    <Layout>
      <Routes>
        <Route path="/" element={<div></div>} />
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Registration />} />
        <Route path="/weapons" element={<Weapons />} />
        <Route path="/armor" element={<Armor />} />
        <Route path="/characters" element={<Characters />} />
        <Route path="*" element={<div></div>} />
      </Routes>
    </Layout>
  )
}

export default App

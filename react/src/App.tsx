import { Route, Routes } from 'react-router-dom'
import './App.css'
import Layout from './components/layout/layout'
import Weapons from './pages/weapons/weapons'
import Armor from './pages/armor/armor'
import Characters from './pages/characters/characters'
import CharacterDetail from './pages/characters/character_detail'
import SkillTree from './pages/skilltree/skilltree'

function App() {
  return (
    <Layout>
      <Routes>
        <Route path="/" element={<div></div>} />
        <Route path="/weapons" element={<Weapons />} />
        <Route path="/armor" element={<Armor />} />
        <Route path="/characters" element={<Characters />} />
        <Route path="/characters/:id" element={<CharacterDetail />} />
        <Route path="/characters/skilltree" element={<SkillTree />} />
        <Route path="*" element={<div></div>} />
      </Routes>
    </Layout>
  )
}

export default App

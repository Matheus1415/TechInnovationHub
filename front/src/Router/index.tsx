// src/Routes.tsx

import React from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import { Header } from '../components/Header';
import { ProfilePage } from '../pages/ProfilePage';
import { HomePage } from '../pages/HomePage';


const AppRoutes: React.FC = () => {
  return (
    <Router>
        <Header/>
        <Routes>
            <Route path="/" element={<HomePage />} />
            <Route path="/profile" element={<ProfilePage />} />
            {/* <Route path="*" element={<NotFoundPage />} /> */}
        </Routes>
    </Router>
  );
};

export default AppRoutes;

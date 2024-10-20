// src/Routes.tsx

import React from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import { HomePage } from '../pages/HomePage';
import { Header } from '../components/Header';


const AppRoutes: React.FC = () => {
  return (
    <Router>
        <Header/>
        <Routes>
            <Route path="/" element={<HomePage />} />
            {/* <Route path="*" element={<NotFoundPage />} /> */}
        </Routes>
    </Router>
  );
};

export default AppRoutes;

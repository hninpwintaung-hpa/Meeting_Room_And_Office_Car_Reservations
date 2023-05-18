import Navbar from "../../components/navbar/Navbar";
import { Sidebar } from "../../components/sidebar/Sidebar";

// import React from 'react';
export const Room  = () => {
    return(
        <div className='home'>
            <Sidebar/>
            <div className="homeContainer">
                <Navbar/>
                <h1>Room Reservation Page</h1>
            </div>
    </div>
    );
};
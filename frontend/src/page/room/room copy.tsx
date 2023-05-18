// import React, { useEffect, useState } from "react";
// import DataTable from "./DataTable";
// import { Sidebar } from "../../components/sidebar/Sidebar";
// import Navbar from "../../components/navbar/Navbar";
// import axios from "axios";
// import SearchByDateButton from "./SearchByDate";
// import SearchByDate from "./SearchByDate";
// import "./roomStyles.css";

// export interface ReservationData {
//   date: string;
//   description: string;
//   end_time: number;
//   id: number;
//   room_id: number;
//   start_time: number;
//   title: string;
//   user_id: number;
// }

// export interface RoomData {
//   id: number;
//   name: string;
// }

// export interface TeamData {
//   id: number;
//   name: string;
// }

// export const Room: React.FC = () => {
//   const [reservationData, setReservationData] = useState<ReservationData[]>([]);
//   const [roomData, setRoomData] = useState<RoomData[]>([]);
//   const [teamData, setTeamData] = useState<TeamData[]>([]);
//   const [searchDate, setSearchDate] = useState(
//     new Date().toISOString().slice(0, 10)
//   );
//   const [SearchByDateData, setSearchByDateData] = useState<ReservationData[]>(
//     []
//   );

//   useEffect(() => {
//     getRoomData();
//     //getTeamData();
//     getTeamData().then((response: any) => {
//       setTeamData(response.data);
//     });
//   }, []);

//   useEffect(() => {
//     handleSearchByDate();
//   }, [searchDate]);

//   const handleSearchByDate = async () => {
//     try {
//       const requestBody = {
//         date: searchDate,
//       };

//       const response = await axios.post(
//         "http://localhost:8000/api/room_reservation/searchByDate",
//         requestBody
//       );
//       if (Array.isArray(response.data.data)) {
//         const data: ReservationData[] = response.data.data.map((item: any) => ({
//           title: item.title,
//           description: item.description,
//           room_id: item.room_id,
//           start_time: Number(item.start_time.split(":")[0]),
//           end_time: Number(item.end_time.split(":")[0]),
//           date: item.date,
//           user_id: item.user_id,
//         }));
//         setSearchByDateData(data);
//       } else {
//         console.error("Invalid data format. Expected an array.");
//       }
//     } catch (error) {
//       console.error(error);
//     }
//   };
//   const getRoomData = async () => {
//     try {
//       const response = await axios.get("http://localhost:8000/api/rooms");
//       setRoomData(response.data.data);
//     } catch (error) {
//       console.error("Error fetching data:", error);
//     }
//   };
//   const getTeamData = () => {
//     return new Promise((resolve, reject) => {
//       axios
//         .get("http://localhost:8000/api/teams")
//         .then((response) => {
//           resolve(response.data);
//           console.log(response.data);
//         })
//         .catch((reason) => {
//           reject(reason);
//         });
//     });
//   };

//   return (
//     <div className="home">
//       <Sidebar />{" "}
//       <div className="homeContainer">
//         <Navbar />
//         <h1>Room Reservation Page</h1>
//         {/* <RoomReservationList /> */}
//         <div className="dateFilter">
//           <input
//             type="date"
//             value={searchDate}
//             onChange={(e) => setSearchDate(e.target.value)}
//           />
//           <button onClick={handleSearchByDate}>Search</button>
//         </div>
//         <DataTable
//           rooms={roomData}
//           reservationData={SearchByDateData}
//           teamData={teamData}
//         />
//       </div>
//     </div>
//   );
// };

// export default Room;
// // export const Room = () => {
// //   return (
// //     <div className="home">
// //       <Sidebar />
// //       <div className="homeContainer">
// //         <Navbar />
// //         <h1>Room Reservation Page</h1>
// //         <RoomReservationList />
// //       </div>
// //     </div>
// //   );
// // };

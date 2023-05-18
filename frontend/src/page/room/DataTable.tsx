import React from "react";
import "./DataTable.css";
import { ReservationData, RoomData, TeamData } from "./room";

interface DataTableProps {
  rooms: RoomData[];
  reservationData: ReservationData[];
  teamData: TeamData[];
}

const DataTable: React.FC<DataTableProps> = ({
  rooms,
  reservationData,
  teamData,
}) => {
  const generateTableData = () => {
    const tableData: JSX.Element[] = [];

    for (let i = 0; i < rooms.length; i++) {
      const room = rooms[i].id;
      const room_name = rooms[i].name;
      const roomData = reservationData.filter((data) => data.room_id === room);
      const cells = [];

      for (let j = 9; j <= 17; j++) {
        const cell = roomData.find(
          (data) => data.start_time <= j && data.end_time > j
        );

        //const isCellInRange = cell && cell.start_time <= j && cell.end_time > j;
        const isFirstCellInRange = cell && cell.start_time === j;

        if (isFirstCellInRange) {
          const span = cell.end_time - cell.start_time + 1;
          cells.push(
            <td
              key={j}
              style={{ backgroundColor: cell ? "yellow" : "white" }}
              colSpan={span}
            >
              <span>{cell.title}</span>
            </td>
          );
          j += span - 1;
        } else {
          cells.push(
            <td
              key={j}
              style={{ backgroundColor: cell ? "yellow" : "white" }}
            ></td>
          );
        }
      }
      tableData.push(
        <tr key={room}>
          <td>{room_name}</td>
          {cells}
        </tr>
      );
    }

    return tableData;
  };

  return (
    <table>
      <thead>
        <tr>
          <th>Room</th>
          <th>9 AM</th>
          <th>10 AM</th>
          <th>11 AM</th>
          <th>12 PM</th>
          <th>1 PM</th>
          <th>2 PM</th>
          <th>3 PM</th>
          <th>4 PM</th>
          <th>5 PM</th>
        </tr>
      </thead>
      <tbody>{generateTableData()}</tbody>
    </table>
  );
};

export default DataTable;

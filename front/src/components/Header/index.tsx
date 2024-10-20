import { TiThMenu } from "react-icons/ti";
import { IoIosSearch } from "react-icons/io";
import { FaRegBell } from "react-icons/fa6";

export const Header = () => {
  return (
    <header className="w-full p-4">
        <div className="bg-slate-800 h-24 text-white rounded-lg shadow-lg flex items-center">
            <div className="w-1/2 p-9 flex items-center gap-8">
                <TiThMenu size={50} className="text-slate-400" />
                <div className="w-full flex items-center gap-4">
                    <label htmlFor="search" className="flex justify-center">
                        <IoIosSearch className="text-slate-600" size={35} />
                    </label>
                    <input
                        type="text"
                        id="search"
                        placeholder="Buscar..."
                        className="w-full border-none min-h-16 focus:outline-none bg-transparent text-white p-2 placeholder:text-2xl placeholder-slate-600"
                    />
                </div>
            </div>
            <div className="w-1/2 h-full flex justify-end items-center gap-4 p-3 text-slate-950 text-xl font-bold">
                <FaRegBell className="text-slate-600" size={30} />
                <div className="bg-slate-400 rounded-full p-4 text-white text-[25px] w-[70px] h-[70px] flex justify-center items-center">MP</div>
            </div>
        </div>
    </header>
  );
};

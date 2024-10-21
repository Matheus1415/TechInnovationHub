import { BoxContent } from "../../components/BoxContent";

export const HomePage = () => {
    return (
        <div className="w-full p-4">
            <div className="w-full h-full grid grid-cols-1 sm:grid-cols-2 gap-4">
                <BoxContent width={100}/>
                <BoxContent width={100}/>
                <BoxContent width={100}/>
                <BoxContent width={100}/>
                <BoxContent width={100}/>
                <BoxContent width={100}/>
                <BoxContent width={100}/>
                <BoxContent width={100}/>
            </div>

        </div>
    );
}
import { BoxContent } from "../../components/BoxContent";

export const HomePage = () => {
    return (
        <div className="w-full p-4">
            <div className="w-full h-full flex space-x-4">
                <BoxContent width={50}/>
                <BoxContent width={50}/>
            </div>
        </div>
    );
}

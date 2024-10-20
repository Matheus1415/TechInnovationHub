import React, { useState, useEffect } from 'react';
import NextJsLogo from '../../assets/ui/js.svg';

interface BoxContentProps {
    width?: 100 | 75 | 65 | 55 | 50 | 45 | 40 | 30 | 20 | 10;
    height?: number;
}

export const BoxContent: React.FC<BoxContentProps> = ({ width = 50, height = 700 }) => {
    const [timeRemaining, setTimeRemaining] = useState('');

    useEffect(() => {
        const totalSeconds = 3700; 
        let remainingSeconds = totalSeconds;

        const intervalId = setInterval(() => {
            const hrs = Math.floor(remainingSeconds / 3600);
            const mins = Math.floor((remainingSeconds % 3600) / 60);
            const secs = remainingSeconds % 60;

            setTimeRemaining(`${hrs.toString().padStart(2, '0')}:${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`);

            remainingSeconds--;

            // Quando atinge zero, limpar o intervalo
            if (remainingSeconds < 0) {
                clearInterval(intervalId);
            }
        }, 1000); // Atualiza a cada 1 segundo

        return () => clearInterval(intervalId); // Limpa o intervalo ao desmontar o componente
    }, []);

    return (
        <div
            style={{ width: `${width}%`, height: `${height}px` }}
            className="bg-slate-800 min-h-[300px] text-white rounded-lg shadow-lg p-6 align-top"
        >
            <div className='p-2 bg-green-200 min-h-10 max-w-[240px] text-center w-full text-[18px] font-bold text-green-800 rounded-lg uppercase'>
                Aceitando propostas
            </div>
            <h1 className='text-[40px] mt-2'>Tecnologia Inovação e conhecimento</h1>
            <div style={{ borderBottom: "1px solid #334155" }} className="mt-6 flex flex-row justify-between">
                <p className="p-1 text-[18px] w-[200px] font-bold">5 de Agosto de 2024</p>
                <p className="p-1 text-[18px] w-[200px] font-bold">Encerra em: {timeRemaining}</p>
            </div>
            <div style={{ borderBottom: "1px solid #334155" }} className="mt-6">
                <p className="p-1 text-[18px] w-full font-bold">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Soluta, fugit doloremque. Veritatis necessitatibus corrupti fugit iste aut, qui officia maxime expedita earum. Officiis commodi aspernatur dignissimos cupiditate dicta reiciendis voluptate. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vel a quisquam odio earum aspernatur enim? Molestias quasi ut aperiam, explicabo odit laborum qui, eos itaque placeat, libero exercitationem non aspernatur.
                </p>
            </div>
            <div style={{ borderBottom: "1px solid #334155" }} className="mt-6">
                <p className="p-1 text-[25px] w-full font-bold uppercase">Tecnologias</p>
                <div className='mt-6 mb-5'>
                    <img src={NextJsLogo} className='w-full max-w-[50px]' alt="Next.js Logo" width={50} height={50} />
                </div>
            </div>
        </div>
    );
};

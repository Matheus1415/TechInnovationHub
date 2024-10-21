import React from 'react';
import { IoLogoJavascript, IoLogoReact } from "react-icons/io5"; 
import { SiPhp, SiAngular, SiLaravel, SiCsharp, SiC, SiKotlin, SiPython, SiR,  SiHtml5, SiCss3, SiTailwindcss, SiSass, SiLess } from "react-icons/si"; 
import { FaJava } from "react-icons/fa";
import { FaVuejs } from "react-icons/fa";
interface IconsDevProps {
    icons: Array<string>;
}

export const IcosDev: React.FC<IconsDevProps> = ({ icons }) => {
    return (
        <div className="flex space-x-4"> 
            {icons.map((icon, index) => {
                switch (icon) {
                    case "js":
                        return <IoLogoJavascript key={index} size={40} color="yellow" />;
                    case "php":
                        return <SiPhp key={index} size={40} color="#777bb3" />;
                    case "react":
                        return <IoLogoReact key={index} size={40} color="#61dafb" />;
                    case "angular":
                        return <SiAngular key={index} size={40} color="#dd0031" />;
                    case "laravel":
                        return <SiLaravel key={index} size={40} color="#ff2d20" />;
                    case "csharp":
                        return <SiCsharp key={index} size={40} color="#239120" />;
                    case "c":
                        return <SiC key={index} size={40} color="#00599c" />;
                    case "java":
                        return <FaJava key={index} size={40} color="#007396" />;
                    case "kotlin":
                        return <SiKotlin key={index} size={40} color="#7f52ff" />;
                    case "python":
                        return <SiPython key={index} size={40} color="#3776ab" />;
                    case "r":
                        return <SiR key={index} size={40} color="#276dc3" />;
                    case "vue":
                        return <FaVuejs key={index} size={40} color="#4fc08d" />;
                    case "html":
                        return <SiHtml5 key={index} size={40} color="#e34f26" />;
                    case "css":
                        return <SiCss3 key={index} size={40} color="#1572b6" />;
                    case "tailwind":
                        return <SiTailwindcss key={index} size={40} color="#38b2ac" />;
                    case "sass":
                        return <SiSass key={index} size={40} color="#cc6699" />;
                    case "less":
                        return <SiLess key={index} size={40} color="#1d365d" />;
                    default:
                        return null;
                }
            })}
        </div>
    );
};

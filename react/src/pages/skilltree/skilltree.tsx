/* eslint-disable @typescript-eslint/no-explicit-any */
import React, { useRef, useState, type JSX } from "react";
import { Stage, Layer, Rect, Text, Line } from "react-konva";
import type { Stage as KonvaStageType } from "konva/lib/Stage";
import { Card, CardHeader, CardTitle, CardContent } from "@/components/ui/card";
import { Button } from "@/components/ui/button";
import styles from "./skilltree.module.css";

interface Skill {
  id: string;
  name: string;
  x: number;
  y: number;
  children?: Skill[];
}

const initialSkills: Skill[] = [
  {
    id: "1",
    name: "Воин",
    x: 400,
    y: 50,
    children: [
      {
        id: "2",
        name: "Мастер меча",
        x: 250,
        y: 150,
        children: [
          { id: "5", name: "Удар молота", x: 200, y: 250 },
        ],
      },
      { id: "3", name: "Щитоносец", x: 550, y: 150 },
      { id: "4", name: "Лучник", x: 400, y: 150 },
    ],
  },
];

export default function SkillTree() {
  const stageRef = useRef<KonvaStageType | null>(null);
  const [skills] = useState<Skill[]>(initialSkills);
  const [selectedSkills, setSelectedSkills] = useState<Skill[]>([]);
  const [hoverSkill, setHoverSkill] = useState<string | null>(null);
  const [scale, setScale] = useState(1);
  const [position, setPosition] = useState({ x: 0, y: 0 });

  // Рендер линий
  const renderLines = (skills: Skill[]): JSX.Element[] => {
    const lines: JSX.Element[] = [];
    skills.forEach(skill => {
      if (skill.children) {
        skill.children.forEach(child => {
          lines.push(
            <Line
              key={`${skill.id}-${child.id}`}
              points={[skill.x + 50, skill.y + 25, child.x + 50, child.y + 25]}
              stroke="#888"
              strokeWidth={2}
            />
          );
        });
        lines.push(...renderLines(skill.children));
      }
    });
    return lines;
  };

  // Рендер навыков
  const renderSkills = (skills: Skill[]): JSX.Element[] => {
    return skills.map(skill => {
      const isSelected = selectedSkills.some(s => s.id === skill.id);

      return (
        <React.Fragment key={skill.id}>
          <Rect
            x={skill.x}
            y={skill.y}
            width={100}
            height={50}
            fill={
              isSelected
                ? "#4f46e5"
                : hoverSkill === skill.id
                ? "#2563eb"
                : "#1f2937"
            }
            cornerRadius={8}
            shadowBlur={5}
            onClick={() => handleSelectSkill(skill)}
            onMouseEnter={() => setHoverSkill(skill.id)}
            onMouseLeave={() => setHoverSkill(null)}
          />
          <Text
            x={skill.x}
            y={skill.y + 15}
            width={100}
            text={skill.name}
            align="center"
            fill="white"
            listening={false}
          />
          {skill.children && renderSkills(skill.children)}
        </React.Fragment>
      );
    });
  };

  // Множественный выбор навыков
  const handleSelectSkill = (skill: Skill) => {
    setSelectedSkills(prev => {
      const alreadySelected = prev.find(s => s.id === skill.id);
      if (alreadySelected) {
        // если уже выбран, снимаем выделение
        return prev.filter(s => s.id !== skill.id);
      } else {
        // добавляем новый
        return [...prev, skill];
      }
    });
  };

  // Панорамирование
  const handleDragEnd = (e: any) => {
    setPosition({ x: e.target.x(), y: e.target.y() });
  };

  // Зум
  const handleWheel = (e: any) => {
    e.evt.preventDefault();
    const scaleBy = 1.05;
    const stage = stageRef.current;
    if (!stage) return;
    const oldScale = stage.scaleX();
    const pointer = stage.getPointerPosition();
    const mousePointTo = {
      x: (pointer!.x - stage.x()) / oldScale,
      y: (pointer!.y - stage.y()) / oldScale,
    };
    const newScale = e.evt.deltaY < 0 ? oldScale * scaleBy : oldScale / scaleBy;
    setScale(newScale);
    setPosition({
      x: pointer!.x - mousePointTo.x * newScale,
      y: pointer!.y - mousePointTo.y * newScale,
    });
  };

  return (
    <div className={styles.skillTree}>
      <Card className={styles.card}>
        <CardHeader>
          <CardTitle>Дерево умений</CardTitle>
        </CardHeader>
        <CardContent>
          <Stage
            width={900}
            height={600}
            ref={stageRef}
            draggable
            x={position.x}
            y={position.y}
            scaleX={scale}
            scaleY={scale}
            onDragEnd={handleDragEnd}
            onWheel={handleWheel}
            style={{ border: "1px solid #444" }}
          >
            <Layer>
              {renderLines(skills)}
              {renderSkills(skills)}
            </Layer>
          </Stage>

          {selectedSkills.length > 0 && (
            <div className={styles.info}>
              <h3>Выбранные навыки:</h3>
              {selectedSkills.map(skill => (
                <p key={skill.id}>{skill.name}</p>
              ))}
              <Button variant="outline" onClick={() => setSelectedSkills([])}>
                Сбросить выбор
              </Button>
            </div>
          )}
        </CardContent>
      </Card>
    </div>
  );
}
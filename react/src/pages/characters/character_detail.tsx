import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import { charactersApi } from "../../api/characters_api";
import type { CharacterDto, SkillDto } from "../../dto/characters.dto";
import styles from "./character_detail.module.css";

interface ExtendedCharacterDto extends CharacterDto {
    user?: {
        name: string;
    }
}

export default function CharacterDetail() {
    const { id } = useParams<{ id: string }>();
    const [character, setCharacter] = useState<ExtendedCharacterDto | null>(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);

    useEffect(() => {
        if (id) {
            charactersApi.getCharacter(id)
                .then(data => setCharacter(data as ExtendedCharacterDto))
                .catch(err => setError(err.message || "Ошибка при загрузке персонажа"))
                .finally(() => setLoading(false));
        }
    }, [id]);

    if (loading) return <div className={styles.loading}>Загрузка...</div>;
    if (error) return <div className={styles.error}>Ошибка: {error}</div>;
    if (!character) return <div className={styles.container}>Персонаж не найден</div>;

    return (
        <div className={styles.sheetContainer}>
            <div className={styles.sheet}>
                {/* --- HEADER SECTION --- */}
                <header className={styles.header}>
                    <div className={styles.nameSection}>
                        <div className={styles.nameValue}>{character.name}</div>
                        <div className={styles.label}>ИМЯ ПЕРСОНАЖА</div>
                    </div>

                    <div className={styles.infoBox}>
                        <div className={styles.infoRow}>
                            <div className={styles.field}>
                                <div className={styles.value}>{character.class || "—"}</div>
                                <div className={styles.label}>КЛАСС</div>
                            </div>
                            <div className={styles.field}>
                                <div className={styles.value}>{character.background || "—"}</div>
                                <div className={styles.label}>ПРЕДЫСТОРИЯ</div>
                            </div>
                        </div>
                        <div className={styles.infoRow}>
                            <div className={styles.field}>
                                <div className={styles.value}>{character.race || "—"}</div>
                                <div className={styles.label}>РАСА</div>
                            </div>
                            <div className={styles.field}>
                                <div className={styles.value}>Н-Д</div>
                                <div className={styles.label}>МИРОВОЗЗРЕНИЕ</div>
                            </div>
                            <div className={styles.field}>
                                <div className={styles.value}>0</div>
                                <div className={styles.label}>ОПЫТ</div>
                            </div>
                            <div className={styles.levelField}>
                                <div className={styles.value}>1</div>
                                <div className={styles.label}>УРОВЕНЬ</div>
                            </div>
                        </div>
                    </div>
                </header>

                {/* --- MAIN CONTENT --- */}
                <main className={styles.mainContent}>

                    {/* Левая колонка: Характеристики и Навыки */}
                    <div className={styles.leftColumn}>
                        <div className={styles.statsContainer}>
                            <StatsBox title="Сила" stat={character.strength} />
                            <StatsBox title="Ловкость" stat={character.dexterity} />
                            <StatsBox title="Телосложение" stat={character.constitution} />
                            <StatsBox title="Интеллект" stat={character.intelligence} />
                            <StatsBox title="Мудрость" stat={character.wisdom} />
                            <StatsBox title="Харизма" stat={character.charisma} />
                        </div>

                        <div className={styles.skillsProficiencyContainer}>
                            {/* Бонус мастерства */}
                            <div className={styles.proficiencyBox}>
                                <div className={styles.profValue}>
                                    +{character.proficiency_bonus || 2}
                                </div>
                                <div className={styles.profLabel}>БОНУС МАСТЕРСТВА</div>
                            </div>

                            {/* Список навыков */}
                            <div className={styles.skillsContainer}>
                                <div className={styles.skillsList}>
                                    {(character.calculated_skills || character.skills)?.map((skill: any) => (
                                        <SkillRow key={skill.id} skill={skill} />
                                    ))}
                                </div>
                                <div className={styles.boxLabelSmall}>НАВЫКИ</div>
                            </div>
                        </div>
                    </div>

                    {/* Правая колонка: Особенности личности */}
                    <div className={styles.personalitySection}>
                        <PersonalityBox title="ЧЕРТЫ ХАРАКТЕРА" content={character.traits} />
                        <PersonalityBox title="ИДЕАЛЫ" content={character.ideals} />
                        <PersonalityBox title="ПРИВЯЗАННОСТИ" content={character.attachments} />
                        <PersonalityBox title="СЛАБОСТИ" content={character.weaknesses} />
                    </div>
                </main>
            </div>
        </div>
    );
}

/**
 * Исправлено: контент теперь может быть string | null | undefined
 */
function PersonalityBox({ title, content }: { title: string; content?: string | null }) {
    return (
        <div className={styles.personalityBox}>
            <div className={styles.boxContent}>
                {content || ""}
            </div>
            <div className={styles.boxFooter}>
                <div className={styles.boxTitle}>{title}</div>
            </div>
        </div>
    );
}

function SkillRow({ skill }: { skill: SkillDto }) {
    const modDisplay = skill.value >= 0 ? `+${skill.value}` : skill.value;

    return (
        <div className={styles.skillRow}>
            <div className={`${styles.skillDot} ${skill.is_proficient ? styles.dotActive : ""}`}>
                {skill.is_expert ? "◈" : ""}
            </div>
            <span className={styles.skillMod}>{modDisplay}</span>
            <span className={styles.skillName}>{skill.name}</span>
            <span className={styles.skillAbility}>({skill.ability.substring(0, 3)})</span>
        </div>
    );
}

function StatsBox({ title, stat }: { title: string; stat: number }) {
    const modifier = Math.floor((stat - 10) / 2);
    const modDisplay = modifier >= 0 ? `+${modifier}` : modifier;

    return (
        <div className={styles.statBox}>
            <div className={styles.statTitle}>{title.toUpperCase()}</div>
            <div className={styles.statModifier}>{modDisplay}</div>
            <div className={styles.statValueContainer}>
                <div className={styles.statValue}>{stat}</div>
            </div>
        </div>
    );
}
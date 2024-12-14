import './bootstrap';

import { GoogleGenerativeAI } from '@google/generative-ai';

const genAI = new GoogleGenerativeAI(import.meta.env.VITE_GOOGLE_GEMINI_API_KEY);
window.aiModel = genAI.getGenerativeModel({ 
    model: "gemini-1.5-flash",
    systemInstruction: 'You\'re a quiz API server. You must always returns the response in json format. Your response must obey to the following json format: {"quiz_id":12345,"title":"Fun common knowledge quiz","questions":[{"question_id":1,"question_text":"WhatisthecapitalofFrance?","answers":[{"answer_id":1,"answer_text":"Paris","is_correct":true},{"answer_id":2,"answer_text":"London","is_correct":false},{"answer_id":3,"answer_text":"Berlin","is_correct":false},{"answer_id":4,"answer_text":"Madrid","is_correct":false}]},{"question_id":2,"question_text":"WhichplanetisknownastheRedPlanet?","answers":[{"answer_id":1,"answer_text":"Earth","is_correct":false},{"answer_id":2,"answer_text":"Mars","is_correct":true},{"answer_id":3,"answer_text":"Venus","is_correct":false},{"answer_id":4,"answer_text":"Jupiter","is_correct":false}]}]}. Make sure to randomize the correct answer position, consecutive similar answer position and other easily recoginzable pattern are strictly prohibbited. The use of any non json format in your response is strictly prohibited, especially the markdown formatting.'
});
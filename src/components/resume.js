import React, { useState } from 'react';
import './resume.css';
const ResumeBuild = () => {
  // Your hook here
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    experience: '',
    education: '',
    skills: '',
  });

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormData((prevData) => ({
      ...prevData,
      [name]: value,
    }));
  };

  const handlePrint = () => {
    window.print();
  };


  return (
    <div className="container">
      {/* Form Section */}
      <div className="form-section">
        <h2>Enter Your Details</h2>
        <form>
          <input
            type="text"
            name="name"
            placeholder="Name"
            value={formData.name}
            onChange={handleInputChange}
          />
          <input
            type="email"
            name="email"
            placeholder="Email"
            value={formData.email}
            onChange={handleInputChange}
          />
          <textarea
            name="experience"
            placeholder="Experience"
            value={formData.experience}
            onChange={handleInputChange}
          />
          <textarea
            name="education"
            placeholder="Education"
            value={formData.education}
            onChange={handleInputChange}
          />
          <textarea
            name="skills"
            placeholder="Skills"
            value={formData.skills}
            onChange={handleInputChange}
          />
        </form>

        <button className="print-button" onClick={handlePrint}>
          Print to PDF
        </button>
      </div>

      {/* Preview Section */}
      <div className="preview-section" id="resume-preview">
        <h2>Resume Preview</h2>
        <div className="preview-box">
          <h3>{formData.name || 'Your Name'}</h3>
          <p>{formData.email || 'Your Email'}</p>
          <h4>Experience</h4>
          <p>{formData.experience || 'Your Experience'}</p>
          <h4>Education</h4>
          <p>{formData.education || 'Your Education'}</p>
          <h4>Skills</h4>
          <p>{formData.skills || 'Your Skills'}</p>
        </div>
      </div>
    </div>
  );
};

export default ResumeBuild;

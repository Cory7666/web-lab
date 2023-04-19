class FrameImage
{
  constructor(link, description)
  {
    this.link = link || "/";
    this.description = description || "No description.";
  }

  createNode()
  {
    return $(`<img src="${this.link}" alt="${this.description}" title="${this.description}" />`);
  }
}

export { FrameImage }
